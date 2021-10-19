import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'stripHtml'
})
export class StripHtmlPipe implements PipeTransform {

  transform(value: any = null): any {
    if ((value === null) || (value === '')) {
      return '';
    } else {
      return value.replace(/<(?:.|\n)*?>/gm, ' ');
    }
  }

}
