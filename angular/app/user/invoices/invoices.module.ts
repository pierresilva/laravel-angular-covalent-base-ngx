import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { InvoicesRoutingModule } from './invoices-routing.module';
import { InvoicesComponent } from './invoices.component';
import { InvoicesDetailComponent } from './components/invoices-detail/invoices-detail.component';
import { InvoicesPaymentComponent } from './components/invoices-payment/invoices-payment.component';
import {SharedModule} from "@shared";


@NgModule({
  declarations: [
    InvoicesComponent,
    InvoicesDetailComponent,
    InvoicesPaymentComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    InvoicesRoutingModule
  ]
})
export class InvoicesModule { }
