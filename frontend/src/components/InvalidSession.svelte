<script lang="ts">
  import Dialog from "./Dialog.svelte"

  let dialog: HTMLDialogElement

  const handleDialogClose = () => {
    dialog.close()
  }
</script>

<Dialog bind:dialog on:close={() => console.log('cerrado')}>
  <div class="flex flex-1 flex-col gap-4">
    <h1 class="text-3xl font-bold">Sesión Inválida</h1>
    <p>Inicia sesión nuevamente</p>
    <button class="px-2 py-1 bg-orange-400" on:click={handleDialogClose}>OK</button>
  </div>
</Dialog>