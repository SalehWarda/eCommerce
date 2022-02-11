<div class="row">
    <div class="col-lg-8">
     <h2 class="h5 text-uppercase mb-4">Shipping Addresses</h2>
        <div class="row">
            @forelse($addresses as $address)
                <div class="col-6 form-group">
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            id="address-{{$address->id}}"
                            class="custom-control-input"
                            wire:model="customer_address_id"
                            wire:click="updateShippingCompanies()"
                            {{intval($customer_address_id) == $address->id ? 'checked' : ''}}
                            value="{{$address->id}}"
                               >
                        <label for="address-{{$address->id}}" class="custom-control-label text-small">
                            <b>{{$address->address_title}}</b>
                            <small>
                                {{$address->address}}<br>
                                {{$address->country->name}} - {{$address->state->name}} - {{$address->city->name}}
                            </small>
                        </label>
                    </div>
                </div>
            @empty
                <p>No addresses found</p>
            @endforelse
        </div>


        <br>

        <div class="row">

            @if($customer_address_id != 0)

                <h2 class="h5 text-uppercase mb-4">Shipping Way</h2>
                <div class="row">
                    @forelse($shipping_companies as $shipping_company)
                        <div class="col-6 form-group">
                            <div class="custom-control custom-radio">
                                <input
                                    type="radio"
                                    id="shipping_company-{{$shipping_company->id}}"
                                    class="custom-control-input"
                                    wire:model="shipping_company_id"
                                    wire:click="updateShippingCost()"
                                    {{intval($shipping_company_id) == $shipping_company->id ? 'checked' : ''}}
                                    value="{{$shipping_company->id}}"
                                >
                                <label for="shipping_company-{{$shipping_company->id}}" class="custom-control-label text-small">
                                    <b>{{$shipping_company->name}}</b>
                                    <small>
                                        {{$address->description}} - (${{$shipping_company->cost}})
                                    </small>
                                </label>
                            </div>
                        </div>
                    @empty
                        <p>No addresses found</p>
                    @endforelse
                </div>

            @endif

        </div>
    </div>

    <!-- ORDER SUMMARY-->
    <div class="col-lg-4">
        <div class="card border-0 rounded-0 p-lg-4 bg-light">
            <div class="card-body">
                <h5 class="text-uppercase mb-4">Your order</h5>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold">Subtotal</strong><span class="text-muted small">${{$cart_subtotal}}</span></li>



                    @if(session()->has('coupon'))

                        <li class="border-bottom my-2"></li>
                        <li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold">Discount<small>({{session()->has('coupon')}})</small></strong><span class="text-muted small">- ${{$cart_discount}}</span></li>

                    @endif





                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold">Tax</strong><span class="text-muted small">${{$cart_tax}}</span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small fw-bold">Total</strong><span>${{$cart_total}}</span></li>
                    <li class="border-bottom my-2"></li>
                    <li>
                        <form wire:submit.prevent="applyDiscount()">

                            @if(!session()->has('coupon'))
                                <input type="text" wire:model="coupon_code" class="form-control"  placeholder="Enter your coupon">

                            @endif

                            @if(session()->has('coupon'))

                                    <div class="input-group mb-0">
                                        <button type="button" wire:click.prevent="removeCoupon()" class="btn btn-danger btn-sm w-100"><i
                                                class="fas fa-gift me-2"></i>Remove coupon
                                        </button>
                                    </div>
                                @else

                                    <div class="input-group mb-0">
                                        <button class="btn btn-dark btn-sm w-100" type="submit"><i
                                                class="fas fa-gift me-2"></i>Apply coupon
                                        </button>
                                    </div>

                            @endif

                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
