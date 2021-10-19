import { TestBed } from '@angular/core/testing';

import { CovalentAuthorService } from './covalent-author.service';

describe('CovalentAuthorService', () => {
  let service: CovalentAuthorService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CovalentAuthorService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
