import {AfterViewInit, ChangeDetectorRef, Component, OnInit, ViewChild} from '@angular/core';
import {TdMediaService} from "@covalent/core/media";
import {MatDialog} from "@angular/material/dialog";
import {TdDigitsPipe} from "@covalent/core/common";
import {DatePipe} from "@angular/common";
import {AuthService} from "@shared";
import {Router} from "@angular/router";
import {Color} from "@swimlane/ngx-charts/lib/utils/color-sets";

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.scss']
})
export class UserComponent implements OnInit, AfterViewInit {

  historical: any[] = [

    {
      month: 'Ene 2020',
      consumption: '30 KWh',
      production: '20 KWh',
      injection: '10 KWh',
      invoiced: '$150.000'
    },
    {
      month: 'Feb 2020',
      consumption: '30 KWh',
      production: '20 KWh',
      injection: '10 KWh',
      invoiced: '$150.000'
    },
    {
      month: 'Mar 2020',
      consumption: '30 KWh',
      production: '20 KWh',
      injection: '10 KWh',
      invoiced: '$150.000'
    },
    {
      month: 'Abr 2020',
      consumption: '30 KWh',
      production: '20 KWh',
      injection: '10 KWh',
      invoiced: '$150.000'
    },
  ];


  times: any[] = [
    {
      'name': 'Inyección',
      'series': [
        {
          'value': 69,
          'name': '2016-09-15T19:25:07.773Z',
        },
        {
          'value': 19,
          'name': '2016-09-17T17:16:53.279Z',
        },
        {
          'value': 85,
          'name': '2016-09-15T10:34:32.344Z',
        },
        {
          'value': 89,
          'name': '2016-09-19T14:33:45.710Z',
        },
        {
          'value': 33,
          'name': '2016-09-12T18:48:58.925Z',
        },
        {
          'value': 37,
          'name': '2016-09-12T22:48:58.925Z',
        }
      ]
    },
    {
      'name': 'Consumo',
      'series': [
        {
          'value': 52,
          'name': '2016-09-15T19:25:07.773Z',
        },
        {
          'value': 49,
          'name': '2016-09-17T17:16:53.279Z',
        },
        {
          'value': 41,
          'name': '2016-09-15T10:34:32.344Z',
        },
        {
          'value': 38,
          'name': '2016-09-19T14:33:45.710Z',
        },
        {
          'value': 72,
          'name': '2016-09-12T18:48:58.925Z',
        },
        {
          'value': 76,
          'name': '2016-09-12T22:48:58.925Z',
        }
      ]
    },
    {
      'name': 'Producción',
      'series': [
        {
          'value': 40,
          'name': '2016-09-15T19:25:07.773Z',
        },
        {
          'value': 45,
          'name': '2016-09-17T17:16:53.279Z',
        },
        {
          'value': 51,
          'name': '2016-09-15T10:34:32.344Z',
        },
        {
          'value': 68,
          'name': '2016-09-19T14:33:45.710Z',
        },
        {
          'value': 54,
          'name': '2016-09-12T18:48:58.925Z',
        },
        {
          'value': 58,
          'name': '2016-09-12T22:48:58.925Z',
        }
      ]
    },
  ];

  @ViewChild('dialogContent') template: any;

  colorScheme: Color = {
    domain: [
      '#FF8A80',
      '#EA80FC',
      '#8C9EFF',
      '#80D8FF',
      '#A7FFEB',
      '#CCFF90',
      '#FFFF8D',
      '#FF9E80'
    ]
  };


  // Timeframe
  dateFrom: Date = new Date(new Date().getTime() - (2 * 60 * 60 * 24 * 1000));
  dateTo: Date = new Date(new Date().getTime() - (1 * 60 * 60 * 24 * 1000));

  // Dialog
  config = {
    width: '50%',
    height: '50%',
  };

  pie: any[] = [];
  single: any[] = [];
  multi: any[] = [];

  constructor(
    public media: TdMediaService,
    public dialog: MatDialog,
    private _changeDetectorRef: ChangeDetectorRef,
    public auth: AuthService,
    public router: Router,
  ) { }

  ngOnInit(): void {
    if (this.auth.hasRole(['admin', 'super_admin'])) {
      this.router.navigateByUrl('/admin');
    }
  }

  ngAfterViewInit() {
    this.media.broadcast();
    this._changeDetectorRef.detectChanges();
  }

  openTemplate() {
    this.dialog.open(this.template, this.config);
  }

  // NGX Charts Axis
  axisDigits(val: any): any {
    return new TdDigitsPipe().transform(val);
  }

  axisDate(val: any): any {
    return new DatePipe('en').transform(val, 'hh a');
  }

  // Theme toggle
  get activeTheme(): any {
    return localStorage.getItem('theme');
  }
  theme(theme: string): void {
    localStorage.setItem('theme', theme);
  }

}
