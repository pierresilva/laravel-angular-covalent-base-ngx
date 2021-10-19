import { Component, OnInit } from '@angular/core';
import {CovalentLayoutService} from "@app/covalent/@layouts/services/covalent-layout.service";

@Component({
  selector: 'app-covalent-main-menu',
  templateUrl: './covalent-main-menu.component.html',
  styleUrls: ['./covalent-main-menu.component.scss']
})
export class CovalentMainMenuComponent implements OnInit {

  constructor(
    public layoutService: CovalentLayoutService,
  ) { }

  ngOnInit(): void {
  }

}
