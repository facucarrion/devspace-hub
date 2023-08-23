<script lang="ts">
	import { login } from "../lib/auth/login";

	const handleLogin = async (event: SubmitEvent) => {
		const form = document.getElementById("login-form");

		event.preventDefault()

		const email = form?.querySelector('input[name="email"]') as HTMLInputElement;
		const password = form?.querySelector('input[name="password"]') as HTMLInputElement;

		const formData = {
			email: email.value,
			password: password.value
		}

		login(formData);
	}
</script>

<form id="login-form" class="flex flex-col items-center border-2 border-black rounded-md p-4 w-1/5 gap-8" on:submit={handleLogin}>
	<h2
		class="text-2xl text-white w-full text-left"
	>
		Log In in DevSpace HUB
	</h2>

	<input
		type="email"
		name="email" 
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Email"
	/>
	<input
		type="password"
		name="password"
		class="w-full border-b-2 border-white bg-transparent focus:outline-none text-white text-lg pl-1"
		placeholder="Password"
	/>

	<button type="submit" class="p-1 bg-orange-500 flex self-end">
		Ingresar
	</button>
</form>