import {Directive, Input, forwardRef, OnInit, OnChanges, SimpleChanges} from '@angular/core';
import {
  NG_VALIDATORS,
  Validator,
  FormControl,
  ValidatorFn,
  AbstractControl,
  ValidationErrors,
  Validators
} from '@angular/forms';
import {isPresent} from './lang';

export const gt = (value: number): ValidatorFn => {
  return (control: AbstractControl): ValidationErrors | null => {
    if (!isPresent(value)) {
      return null;
    }
    if (isPresent(Validators.required(control))) {
      return null;
    }

    const v: number = +control.value;
    return v > +value ? null : {gt: {value: value}};
  };
};

const GREATER_THAN_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateGreaterThanDirective),
  multi: true
};

@Directive({
  selector: '[gt][formControlName],[gt][formControl],[gt][ngModel]',
  providers: [GREATER_THAN_VALIDATOR]
})
export class ValidateGreaterThanDirective implements Validator, OnInit, OnChanges {

  @Input() gt: number | any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = gt(this.gt);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (const key in changes) {
      if (key === 'gt') {
        this.validator = gt(changes[key].currentValue);
        if (this.onChange) {
          this.onChange();
        }
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
