@extends('auth.layouts')
@section('title')
    405 Not Found
@endsection

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v3" style="background-image: url('{{asset("assets/media/error-bg.jpg")}}')">
        <div class="kt-error_container">
					<span class="kt-error_number">
						<h1>405</h1>
					</span>
            <p class="kt-error_title kt-font-light">
                How did you get here ?
            </p>
            <p class="kt-error_subtitle">
                Sorry we can't seem to find the page you're looking for.
            </p>
            <p class="kt-error_description">
                There may be amisspelling in the URL entered,<br>
                or the page you are looking for may no longer exist.
            </p>
        </div>
    </div>
@endsection
