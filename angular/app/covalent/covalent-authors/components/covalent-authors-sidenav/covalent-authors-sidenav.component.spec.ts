import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CovalentAuthorsSidenavComponent } from './covalent-authors-sidenav.component';

describe('CovalentAuthorsSidenavComponent', () => {
  let component: CovalentAuthorsSidenavComponent;
  let fixture: ComponentFixture<CovalentAuthorsSidenavComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CovalentAuthorsSidenavComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CovalentAuthorsSidenavComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
