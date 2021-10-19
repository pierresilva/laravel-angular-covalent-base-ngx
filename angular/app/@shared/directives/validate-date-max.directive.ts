import { Directive, Input, forwardRef, OnInit, OnChanges, SimpleChanges } from '@angular/core';
import {NG_VALIDATORS, Validator, ValidatorFn, AbstractControl, Validators} from '@angular/forms';
import {isDate, isPresent} from './lang';

export const maxDate = (maxDate: any): ValidatorFn => {
  if (!isDate(maxDate) && !(maxDate instanceof Function)) {
    throw Error('maxDate value must be or return a formatted date');
  }

  return (control: AbstractControl): {[key: string]: any} | any => {
    if (isPresent(Validators.required(control))) return null;

    let d: Date = new Date(control.value);

    if (!isDate(d)) return {maxDate: true};
    if (maxDate instanceof Function) maxDate = maxDate();

    return d <= new Date(maxDate) ? null : {maxDate: true};
  };
};

const MAX_DATE_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateDateMaxDirective),
  multi: true
};

@Directive({
  selector: '[maxDate][formControlName],[maxDate][formControl],[maxDate][ngModel]',
  providers: [MAX_DATE_VALIDATOR]
})
export class ValidateDateMaxDirective implements Validator, OnInit, OnChanges {
  @Input() maxDate: any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = maxDate(this.maxDate);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (let key in changes) {
      if (key === 'maxDate') {
        this.validator = maxDate(changes[key].currentValue);
        if (this.onChange) this.onChange();
      }
    }
  }

  validate(c: AbstractControl): {[key: string]: any} {
    return this.validator(c);
  }

  registerOnValidatorChange(fn: () => void): void {
    this.onChange = fn;
  }
}
