import { Inject, Injectable } from '@angular/core';
import { StorageService } from '@shared/services/storage.service';

@Injectable({
  providedIn: 'root',
})
export class StorageSessionService extends StorageService {
  constructor(@Inject('WINDOW') private window: any) {
    super(window.sessionStorage);
  }
}
