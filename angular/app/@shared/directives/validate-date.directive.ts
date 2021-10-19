import { Directive, forwardRef } from '@angular/core';
import {NG_VALIDATORS, Validator, AbstractControl, ValidatorFn, Validators} from '@angular/forms';
import {isDate, isPresent} from './lang';

export const date: ValidatorFn = (control: AbstractControl): null | { date: boolean } => {
  if (isPresent(Validators.required(control))) return null;

  let v: string = control.value;
  return isDate(v) ? null : {date: true};
};

const DATE_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateDateDirective),
  multi: true
};

@Directive({
  selector: '[date][formControlName],[date][formControl],[date][ngModel]',
  providers: [DATE_VALIDATOR]
})
export class ValidateDateDirective implements Validator {
  validate(c: AbstractControl): {[key: string]: any} | any {
    return date(c);
  }
}
