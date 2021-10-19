import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CovalentAuthorsViewComponent } from './covalent-authors-view.component';

describe('CovalentAuthorsViewComponent', () => {
  let component: CovalentAuthorsViewComponent;
  let fixture: ComponentFixture<CovalentAuthorsViewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CovalentAuthorsViewComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CovalentAuthorsViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
