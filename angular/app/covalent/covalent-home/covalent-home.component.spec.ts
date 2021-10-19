import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CovalentHomeComponent } from './covalent-home.component';

describe('CovalentHomeComponent', () => {
  let component: CovalentHomeComponent;
  let fixture: ComponentFixture<CovalentHomeComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CovalentHomeComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CovalentHomeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
