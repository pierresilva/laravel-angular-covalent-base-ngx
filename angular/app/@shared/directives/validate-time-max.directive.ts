import { Directive, Input, forwardRef, OnInit, OnChanges, SimpleChanges } from '@angular/core';
import {NG_VALIDATORS, Validator, ValidatorFn, AbstractControl, Validators} from '@angular/forms';
import {isDate, isPresent} from '@shared/directives/lang';

export const maxTime = (maxTime: any): ValidatorFn | null => {

  if (!(maxTime)) {
    return null;
  }

  return (control: AbstractControl): { [p: string]: any } | null => {
    if (isPresent(Validators.required(control))) return null;

    let t: any = new Date('2020-01-01 ' + control.value).getTime();

    if (!isDate(t)) return {maxTime: true};
    if (maxTime instanceof Function) maxTime = maxTime();

    return t <= new Date('2020-01-01 ' + maxTime) ? null : {maxTime: true};
  };
};

const MIN_DATE_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateTimeMaxDirective),
  multi: true
};

@Directive({
  selector: '[maxTime][formControlName],[maxTime][formControl],[maxTime][ngModel]',
  providers: [MIN_DATE_VALIDATOR]
})
export class ValidateTimeMaxDirective implements Validator, OnInit, OnChanges {
  @Input() maxTime: any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = maxTime(this.maxTime);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (let key in changes) {
      if (key === 'maxTime') {
        this.validator = maxTime(changes[key].currentValue);
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
