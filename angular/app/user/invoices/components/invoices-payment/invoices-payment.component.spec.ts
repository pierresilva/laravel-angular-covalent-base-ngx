import { ComponentFixture, TestBed } from '@angular/core/testing';

import { InvoicesPaymentComponent } from './invoices-payment.component';

describe('InvoicesPaymentComponent', () => {
  let component: InvoicesPaymentComponent;
  let fixture: ComponentFixture<InvoicesPaymentComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ InvoicesPaymentComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(InvoicesPaymentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
