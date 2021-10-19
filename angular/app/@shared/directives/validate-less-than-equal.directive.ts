import {Directive, forwardRef, Input, SimpleChanges} from '@angular/core';
import {AbstractControl, NG_VALIDATORS, ValidationErrors, ValidatorFn, Validators} from "@angular/forms";
import {isPresent} from "@shared/directives/lang";

export const lte = (value: number): ValidatorFn => {
  return (control: AbstractControl): ValidationErrors | null => {
    if (!isPresent(value)) {
      return null;
    }
    if (isPresent(Validators.required(control))) {
      return null;
    }

    const v: number = +control.value;
    return v <= +value ? null : { lte: { value: value } };
  };
};

const LESS_THAN_EQUAL_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateLessThanEqualDirective),
  multi: true
};

@Directive({
  selector: '[lte][formControlName],[lte][formControl],[lte][ngModel]',
  providers: [LESS_THAN_EQUAL_VALIDATOR]
})
export class ValidateLessThanEqualDirective {

  @Input() lte: number | any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = lte(this.lte);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (const key in changes) {
      if (key === 'lte') {
        this.validator = lte(changes[key].currentValue);
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
