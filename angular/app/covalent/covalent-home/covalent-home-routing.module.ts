import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {CovalentHomeComponent} from "@app/covalent/covalent-home/covalent-home.component";

const routes: Routes = [
  {
    path: '',
    component: CovalentHomeComponent
  }


];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CovalentHomeRoutingModule { }
