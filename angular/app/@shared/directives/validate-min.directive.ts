import { Directive, Input, forwardRef, OnInit, OnChanges, SimpleChanges } from '@angular/core';
import {NG_VALIDATORS, Validator, ValidatorFn, AbstractControl, Validators} from '@angular/forms';
import {isDate, isPresent} from './lang';

export const min = (min: number): ValidatorFn => {
  return (control: AbstractControl): { [p: string]: any } | null => {
    if (!isPresent(min)) return null;
    if (isPresent(Validators.required(control))) return null;

    let v: number = +control.value;
    return v >= +min ? null : {actualValue: v, requiredValue: +min, min: true};
  };
};

const MIN_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateMinDirective),
  multi: true
};

@Directive({
  selector: '[min][formControlName],[min][formControl],[min][ngModel]',
  providers: [MIN_VALIDATOR]
})
export class ValidateMinDirective implements Validator, OnInit, OnChanges {
  @Input() min: number | any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = min(this.min);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (let key in changes) {
      if (key === 'min') {
        this.validator = min(changes[key].currentValue);
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
