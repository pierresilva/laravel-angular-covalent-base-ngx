import { Pipe, PipeTransform } from '@angular/core';
import * as moment from 'moment';

@Pipe({
  name: 'dateFormat'
})
export class DateFormatPipe implements PipeTransform {

  transform(value: any, format: string = 'DD/MM/YYYY'): any {
    if (value && format) {

      if (format == 'HH:mm') {
        return moment('1990-01-01 ' + value).format(format);
      }

      return moment(value).format(format);

    }

    return value;
  }

}
