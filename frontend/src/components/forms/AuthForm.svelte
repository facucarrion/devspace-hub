<script lang="ts">
  import InvalidSession from "../ui/InvalidSession.svelte"
  import LoginForm from "./LoginForm.svelte"
  import RegisterForm from "./RegisterForm.svelte"

  const Forms = {
    login: {
      action: 'login',
      buttonText: 'Log In',
      changeFormText: "Don\'t have an account? Register here"
    },
    register: {
      action: 'register',
      buttonText: 'Register',
      changeFormText: "Already have an account? Log In here"
    }
  }

  let activeForm = Forms.login;
</script>

<main class="flex flex-col justify-center items-center flex-grow gap-4 w-full max-w-[400px]">
  {#if activeForm.action === "login"}
    <LoginForm />
  {:else if activeForm.action === "register"}
    <RegisterForm />
  {/if}

  {#if new URL(location.href).searchParams.get('session') === 'invalid'}
    <InvalidSession />
  {/if}

  <button
    class="text-base text-white"
    on:click={() => activeForm = activeForm.action === "login" ? Forms.register : Forms.login}
  >
    {activeForm.changeFormText}
  </button>

  <a href="http://localhost:3000/" class="underline">Ir a la página principal</a>
</main>
