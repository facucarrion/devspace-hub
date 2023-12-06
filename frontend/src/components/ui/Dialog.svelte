<script>
  export let dialog
</script>

<dialog open bind:this={dialog} on:close class="p-4 gap-4">
  <slot />
</dialog>