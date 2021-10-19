import { TestBed } from '@angular/core/testing';

import { CovalentLayoutService } from './covalent-layout.service';

describe('CovalentLayoutService', () => {
  let service: CovalentLayoutService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CovalentLayoutService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
