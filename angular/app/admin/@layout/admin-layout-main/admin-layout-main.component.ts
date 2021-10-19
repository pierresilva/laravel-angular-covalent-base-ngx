import { Component, OnInit } from '@angular/core';
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-admin-layout-main',
  templateUrl: './admin-layout-main.component.html',
  styleUrls: ['./admin-layout-main.component.scss']
})
export class AdminLayoutMainComponent implements OnInit {

  constructor(
    public layoutService: AdminLayoutServiceService
  ) { }

  ngOnInit(): void {
  }

}
