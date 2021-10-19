import { Directive, Input, forwardRef, OnInit, OnChanges, SimpleChanges } from '@angular/core';
import {NG_VALIDATORS, Validator, ValidatorFn, AbstractControl, Validators} from '@angular/forms';
import {isDate, isPresent} from '@shared/directives/lang';

export const minDate = (minTime: any): ValidatorFn | null => {

  if (!(minTime)) {
    return null;
  }

  return (control: AbstractControl): {[key: string]: any} | null => {
    if (isPresent(Validators.required(control))) return null;

    let t: any = new Date('2020-01-01 ' + control.value).getTime();

    if (!isDate(t)) return {minTime: true};
    if (minTime instanceof Function) minTime = minTime();

    return t >= new Date('2020-01-01 ' + minTime) ? null : {minTime: true};
  };
};

const MIN_DATE_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateTimeMinDirective),
  multi: true
};

@Directive({
  selector: '[minTime][formControlName],[minTime][formControl],[minTime][ngModel]',
  providers: [MIN_DATE_VALIDATOR]
})
export class ValidateTimeMinDirective implements Validator, OnInit, OnChanges {
  @Input() minTime: any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = minDate(this.minTime);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (let key in changes) {
      if (key === 'minTime') {
        this.validator = minDate(changes[key].currentValue);
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
