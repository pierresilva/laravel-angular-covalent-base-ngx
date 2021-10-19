import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CovalentAuthosListComponent } from './covalent-authos-list.component';

describe('CovalentAuthosListComponent', () => {
  let component: CovalentAuthosListComponent;
  let fixture: ComponentFixture<CovalentAuthosListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CovalentAuthosListComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CovalentAuthosListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
