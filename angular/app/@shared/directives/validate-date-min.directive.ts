import { Directive, Input, forwardRef, OnInit, OnChanges, SimpleChanges } from '@angular/core';
import {NG_VALIDATORS, Validator, ValidatorFn, AbstractControl, Validators} from '@angular/forms';
import {isDate, isPresent} from '@shared/directives/lang';

export const minDate = (minDate: any): ValidatorFn => {

  if (!isDate(minDate) && !(minDate instanceof Function)) {
    throw Error('minDate value must be or return a formatted date');
  }

  return (control: AbstractControl): {[key: string]: any} | any => {
    if (isPresent(Validators.required(control))) return null;

    let d: Date = new Date(control.value);

    if (!isDate(d)) return {minDate: true};
    if (minDate instanceof Function) minDate = minDate();

    return d >= new Date(minDate) ? null : {minDate: true};
  };
};

const MIN_DATE_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateDateMinDirective),
  multi: true
};

@Directive({
  selector: '[minDate][formControlName],[minDate][formControl],[minDate][ngModel]',
  providers: [MIN_DATE_VALIDATOR]
})
export class ValidateDateMinDirective implements Validator, OnInit, OnChanges {
  @Input() minDate: any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = minDate(this.minDate);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (let key in changes) {
      if (key === 'minDate') {
        this.validator = minDate(changes[key].currentValue);
        if (this.onChange) this.onChange();
      }
    }
  }

  validate(c: AbstractControl): {[key: string]: any} | any {
    return this.validator(c);
  }

  registerOnValidatorChange(fn: () => void): void {
    this.onChange = fn;
  }
}
