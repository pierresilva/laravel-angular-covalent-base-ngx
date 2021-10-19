import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CovalentAuthorsComponent } from './covalent-authors.component';

describe('CovalentAuthorsComponent', () => {
  let component: CovalentAuthorsComponent;
  let fixture: ComponentFixture<CovalentAuthorsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CovalentAuthorsComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CovalentAuthorsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
