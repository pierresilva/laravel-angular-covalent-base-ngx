import {AfterViewInit, ChangeDetectorRef, Component, OnInit, TemplateRef, ViewChild} from '@angular/core';
import {TdMediaService} from "@covalent/core/media";
import {MatDialog} from "@angular/material/dialog";
import {TdDigitsPipe} from "@covalent/core/common";
import {DatePipe} from "@angular/common";

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.scss']
})
export class AdminComponent implements OnInit, AfterViewInit {

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

  // Data table
  data: any[] = [
    {
      'name': 'Frozen yogurt',
      'type': 'Ice cream',
      'calories': 159.0,
      'fat': 6.0,
      'carbs': 24.0,
      'protein': 4.0,
    }, {
      'name': 'Ice cream sandwich',
      'type': 'Ice cream',
      'calories': 237.0,
      'fat': 9.0,
      'carbs': 37.0,
      'protein': 4.3,
    }, {
      'name': 'Eclair',
      'type': 'Pastry',
      'calories':  262.0,
      'fat': 16.0,
      'carbs': 24.0,
      'protein':  6.0,
    }, {
      'name': 'Cupcake',
      'type': 'Pastry',
      'calories':  305.0,
      'fat': 3.7,
      'carbs': 67.0,
      'protein': 4.3,
    }, {
      'name': 'Jelly bean',
      'type': 'Candy',
      'calories':  375.0,
      'fat': 0.0,
      'carbs': 94.0,
      'protein': 0.0,
    }, {
      'name': 'Lollipop',
      'type': 'Candy',
      'calories': 392.0,
      'fat': 0.2,
      'carbs': 98.0,
      'protein': 0.0,
    }, {
      'name': 'Honeycomb',
      'type': 'Other',
      'calories': 408.0,
      'fat': 3.2,
      'carbs': 87.0,
      'protein': 6.5,
    }, {
      'name': 'Donut',
      'type': 'Pastry',
      'calories': 452.0,
      'fat': 25.0,
      'carbs': 51.0,
      'protein': 4.9,
    }, {
      'name': 'KitKat',
      'type': 'Candy',
      'calories': 518.0,
      'fat': 26.0,
      'carbs': 65.0,
      'protein': 7.0,
    }, {
      'name': 'Chocolate',
      'type': 'Candy',
      'calories': 518.0,
      'fat': 26.0,
      'carbs': 65.0,
      'protein': 7.0,
    }, {
      'name': 'Chamoy',
      'type': 'Candy',
      'calories': 518.0,
      'fat': 26.0,
      'carbs': 65.0,
      'protein': 7.0,
    },
  ];

  times: any[] = [
    {
      'name': 'Production',
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
      'name': 'Consumption',
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
      'name': 'Injection',
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
  ) { }

  ngOnInit(): void {
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
