import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'ellipsis'
})
export class EllipsisPipe implements PipeTransform {

  transform(target: string, maxLength: number = 300) {
    const htmlStripped = target.replace(/(<([^>]+)>)/gi, '');

    if (htmlStripped.length >= maxLength) {
      return `${htmlStripped.slice(0, maxLength)}...`;
    }
    return htmlStripped;
  }

}
