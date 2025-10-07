<x-auth::master>

	<x-form class="pt-3" action="{{ route('employee.login') }}" id="login" :has-default-buttons="false" method="POST">

		<x-form-group>
			<x-label :is-required="true" text="نام کاربری" />
			<x-input type="text" name="username" placeholder="نام کاربری را وارد کنید" autofocus required />
		</x-form-group>

		<x-form-group>
			<x-label :is-required="true" text="رمز عبور" />
			<x-input type="password" name="password" placeholder="رمز عبور را وارد کنید" required />
		</x-form-group>

		<div class="submit">
			<button class="btn btn-primary btn-block disableable">ورود</button>
		</div>
	</x-form>

</x-auth::master>