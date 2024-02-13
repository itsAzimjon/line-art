@extends('layouts.app')
@section('content')
<h1 class="h1 mt-5">Choose the plan that fits for your team</h1>
<p class="p">
    Deploy your sites to global infrastructure in seconds. No credit card
    required
</p>

<div class="pricing mb-5 pb-5">
    <div class="plan">
        <h2 class="h2">Dev</h2>
        <div class="price">FREE</div>
        <ul class="features ul">
            <li class="li"><i class="fas fa-check-circle"></i> Unlimited Websites</li>
            <li class="li"><i class="fas fa-check-circle"></i> 1 User</li>
            <li class="li"><i class="fas fa-check-circle"></i> 100MB Space/website</li>
            <li class="li"><i class="fas fa-check-circle"></i> Continuous deployment</li>
            <li class="li"><i class="fas fa-times-circle"></i> No priority support</li>
        </ul>
        <button class="button">Signup</button>
    </div>
    <form action="{{ route('credit')}}" method="put">
        @csrf
        <div class="plan popular">
            <span class="span">Most Popular</span>
            <h2 class="h2">Pro</h2>
            <input name="credit" type="hidden" value="5000">
            <div class="price">$10/month</div>
            <ul class="features ul">
                <li class="li"><i class="fas fa-check-circle"></i> Unlimited Websites</li>
                <li class="li"><i class="fas fa-check-circle"></i> 5 Users</li>
                <li class="li"><i class="fas fa-check-circle"></i> 512MB Space/website</li>
                <li class="li"><i class="fas fa-check-circle"></i> Continuous deployment</li>
                <li class="li"><i class="fas fa-check-circle"></i> Email Support</li>
            </ul>
            <button type="submit" class="button">Buy Now</button>
        </div>
    </form>
    <div class="plan">
        <h2 class="h2">Enterprise</h2>
        <div class="price">Custom Pricing</div>
        <ul class="features">
            <li class="li"><i class="fas fa-check-circle"></i> Unlimited Websites</li>
            <li class="li"><i class="fas fa-check-circle"></i> Unlimited Users</li>
            <li class="li"><i class="fas fa-check-circle"></i> Unlimited Space/website</li>
            <li class="li"><i class="fas fa-check-circle"></i> Continuous deployment</li>
            <li class="li"><i class="fas fa-check-circle"></i> 24/7 Email support</li>
        </ul>
        <button class="button">Contact Us</button>
    </div>
</div>
@endsection