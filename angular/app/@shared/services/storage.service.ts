import { BehaviorSubject, Observable } from 'rxjs';
import { environment } from '@env/environment';
import { Injectable } from '@angular/core';
import * as CryptoJS from 'crypto-js';

@Injectable({
  providedIn: 'root',
})
export class StorageService {
  public keySize = 256;
  public ivSize = 128;
  public iterations = 100;

  private storage:  Storage | any;
  private subjects: Map<string, BehaviorSubject<any>> | any;

  constructor(storage: Storage) {
    this.storage = storage;
    this.subjects = new Map<string, BehaviorSubject<any>>();
  }

  encrypt(data: any) {
    return CryptoJS.AES.encrypt(JSON.stringify(data), environment.secretKey).toString();
  }

  decrypt(data: any) {
    const bytes = CryptoJS.AES.decrypt(data, environment.secretKey);
    if (bytes.toString()) {
      return JSON.parse(bytes.toString(CryptoJS.enc.Utf8));
    }
    return data;
  }

  public getStorage() {
    const s = [];
    for (let i = 0; i < this.storage.length; i++) {
      s.push({
        key: atob(this.storage.key(i)),
        value: JSON.parse(this.decrypt(this.storage.getItem(this.storage.key(i)))),
      });
    }
    return s;
  }

  watch(key: string): Observable<any> | null | undefined {
    key = btoa(key);
    if (!this.subjects.has(key)) {
      this.subjects.set(key, new BehaviorSubject<any>(null));
    }
    if (!this.storage.getItem(key)) {
      return undefined;
    }
    const value = this.decrypt(this.storage.getItem(key));
    let item = JSON.parse(value);
    if (item === 'undefined') {
      item = undefined;
    }
    this.subjects.get(key).next(item);
    return this.subjects.get(key).asObservable();
  }

  get(key: string): any {
    key = btoa(key);
    if (!this.storage.getItem(key)) {
      return undefined;
    }
    const value = this.decrypt(this.storage.getItem(key));
    let item = JSON.parse(value);
    if (item === 'undefined') {
      item = undefined;
    }
    return item;
  }

  set(key: string, value: any) {
    key = btoa(key);
    value = JSON.stringify(value);
    this.storage.setItem(key, this.encrypt(value));
    if (!this.subjects.has(key)) {
      this.subjects.set(key, new BehaviorSubject<any>(value));
    } else {
      this.subjects.get(key).next(value);
    }
  }

  remove(key: string) {
    key = btoa(key);
    if (this.subjects.has(key)) {
      this.subjects.get(key).complete();
      this.subjects.delete(key);
    }
    this.storage.removeItem(key);
  }

  clear() {
    this.subjects.clear();
    this.storage.clear();
  }
}
