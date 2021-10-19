import {Directive, forwardRef, Input, SimpleChanges} from '@angular/core';
import {AbstractControl, NG_VALIDATORS, ValidationErrors, ValidatorFn, Validators} from "@angular/forms";
import {isPresent} from "@shared/directives/lang";

export const lt = (value: number): ValidatorFn => {
  return (control: AbstractControl): ValidationErrors | null => {
    if (!isPresent(value)) {
      return null;
    }
    if (isPresent(Validators.required(control))) {
      return null;
    }

    const v: number = +control.value;
    return v < +value ? null : { lt: { value: value } };
  };
};

const LESS_THAN_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateLessThanDirective),
  multi: true
};

@Directive({
  selector: '[lt][formControlName],[lt][formControl],[lt][ngModel]',
  providers: [LESS_THAN_VALIDATOR]
})
export class ValidateLessThanDirective {

  @Input() lt: number | any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = lt(this.lt);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (const key in changes) {
      if (key === 'lt') {
        this.validator = lt(changes[key].currentValue);
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
