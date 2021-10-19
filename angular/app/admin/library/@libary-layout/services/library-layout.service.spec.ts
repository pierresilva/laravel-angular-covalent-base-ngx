import { TestBed } from '@angular/core/testing';

import { LibraryLayoutService } from './library-layout.service';

describe('LibraryLayoutService', () => {
  let service: LibraryLayoutService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(LibraryLayoutService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
