import {Component, OnInit} from '@angular/core';
import {AdminLayoutServiceService} from "@app/admin/@layout/services/admin-layout-service.service";

@Component({
  selector: 'app-admin-menu-main',
  templateUrl: './admin-menu-main.component.html',
  styleUrls: ['./admin-menu-main.component.scss']
})
export class AdminMenuMainComponent implements OnInit {

  constructor(
    public layoutService: AdminLayoutServiceService
  ) {
  }

  ngOnInit(): void {
  }

}
