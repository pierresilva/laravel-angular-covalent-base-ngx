import { Component, OnInit } from '@angular/core';
import {CovalentLayoutService} from "@app/covalent/@layouts/services/covalent-layout.service";

@Component({
  selector: 'app-covalent-module-menu',
  templateUrl: './covalent-module-menu.component.html',
  styleUrls: ['./covalent-module-menu.component.scss']
})
export class CovalentModuleMenuComponent implements OnInit {

  constructor(
    public layoutService: CovalentLayoutService,
  ) { }

  ngOnInit(): void {
  }

}
