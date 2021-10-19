import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CovalentAuthorsFormComponent } from './covalent-authors-form.component';

describe('CovalentAuthorsFormComponent', () => {
  let component: CovalentAuthorsFormComponent;
  let fixture: ComponentFixture<CovalentAuthorsFormComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CovalentAuthorsFormComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CovalentAuthorsFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
