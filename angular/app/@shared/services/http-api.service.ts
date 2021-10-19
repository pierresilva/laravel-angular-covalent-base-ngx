import {Injectable} from '@angular/core';
import {HttpClient, HttpParams, HttpBackend} from '@angular/common/http';
import {Observable, throwError, of} from 'rxjs';
import {catchError} from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class HttpApiService {

  private httpWithoutInterceptor: HttpClient;

  constructor(
    private http: HttpClient,
    private httpBackend: HttpBackend
  ) {
    this.httpWithoutInterceptor = new HttpClient(httpBackend);
  }

  /**
   *
   * @param error
   * @private
   */
  private formatErrors(error: any) {
    return throwError(error.error);
  }

  /**
   *
   * @param path
   * @param params
   */
  get(path: string, params: HttpParams = new HttpParams()): Observable<any> {
    return this.http.get(`${path}`, {params})
      .pipe(catchError(this.formatErrors));
  }

  /**
   *
   * @param path
   * @param body
   */
  put(path: string, body: Object = {}): Observable<any> {
    return this.http.put(
      `${path}`,
      body
    ).pipe(catchError(this.formatErrors));
  }

  /**
   *
   * @param path
   * @param body
   * @param options
   */
  post(path: string, body: Object = {}, options: Object = {}): Observable<any> {
    return this.http.post(
      `${path}`,
      body,
      options
    ).pipe(catchError(this.formatErrors));
  }

  /**
   *
   * @param path
   */
  delete(path: string): Observable<any> {
    return this.http.delete(
      `${path}`
    ).pipe(catchError(this.formatErrors));
  }

  /**
   *
   * @param path
   * @param params
   */
  _get(path: string, params: HttpParams = new HttpParams()): Observable<any> {
    return this.httpWithoutInterceptor.get(`${path}`, {params})
      .pipe(catchError(this.formatErrors));
  }

  /**
   *
   * @param path
   * @param body
   */
  _put(path: string, body: Object = {}): Observable<any> {
    return this.httpWithoutInterceptor.put(
      `${path}`,
      JSON.stringify(body)
    ).pipe(catchError(this.formatErrors));
  }

  /**
   *
   * @param path
   * @param body
   * @param options
   */
  _post(path: string, body: Object = {}, options: Object = {}): Observable<any> {
    return this.httpWithoutInterceptor.post(
      `${path}`,
      JSON.stringify(body),
      options
    ).pipe(catchError(this.formatErrors));
  }

  /**
   *
   * @param path
   */
  _delete(path: string): Observable<any> {
    return this.httpWithoutInterceptor.delete(
      `${path}`
    ).pipe(catchError(this.formatErrors));
  }
}
