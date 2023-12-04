  <script lang="ts">
    import { getTags } from '@lib/tags/getTags'
    import { insertTagsAlternative } from '@lib/tagProjects/insertTagsAlternative'

    export let id_project: string

    const handleTags = async (event: SubmitEvent) => {
      event.preventDefault()

      const form = event.target as HTMLFormElement

      const alcance = form.querySelector('select[name=alcance]') as HTMLInputElement;
      const dominio = form.querySelector('select[name=dominio]') as HTMLInputElement;
      const naturaleza = form.querySelector('select[name=naturaleza]') as HTMLInputElement;
      const plataforma = form.querySelector('select[name=plataforma]') as HTMLInputElement;
      const proposito = form.querySelector('select[name=propósito]') as HTMLInputElement;
      const tipo = form.querySelector('select[name=tipo]') as HTMLInputElement;
      
      const formData = {
        alcance: alcance.value,
        dominio: dominio.value,
        naturaleza: naturaleza.value,
        plataforma: plataforma.value,
        proposito: proposito.value,
        tipo: tipo.value
      }

      const response = await insertTagsAlternative(formData, id_project)

      if(response) {
        location.href = `http://localhost:3000/projects/${id_project}`
      }
    }

    let tags: {
      Alcance: {
        id_tag: string,
        tag: string,
        checked: boolean
      }[],
      Dominio: {
        id_tag: string,
        tag: string,
        checked: boolean
      }[],
      Naturaleza: {
        id_tag: string,
        tag: string,
        checked: boolean
      }[],
      Plataforma: {
        id_tag: string,
        tag: string,
        checked: boolean
      }[],
      Propósito: {
        id_tag: string,
        tag: string,
        checked: boolean
      }[],
      Tipo: {
        id_tag: string,
        tag: string,
        checked: boolean
      }[],
    } = {
      Alcance: [],
      Dominio: [],
      Naturaleza: [],
      Plataforma: [],
      Propósito: [],
      Tipo: [],
    }


    $: {
      getTags(id_project).then((res) => {
        tags = res
      })
    }
  </script> 

  <form 
  id="tags-project"
  class="flex flex-col w-full"
  on:submit={handleTags}
  >

  <h2 class="font-bold ml-1 text-xl">Alcance del Proyecto:</h2>
  <select name="alcance" class="text-xl bg-transparent border-b-2 border-white focus:outline-none mb-6">
    {#each tags.Alcance as tag}
      <option selected={tag.checked} value={tag.id_tag} class="text-black">{tag.tag}</option>
    {/each}
  </select>

  <h2 class="font-bold ml-1 text-xl">Dominio del Proyecto:</h2>
  <select name="dominio" class="text-xl bg-transparent border-b-2 border-white focus:outline-none mb-6">
    {#each tags.Dominio as tag}
      <option selected={tag.checked} value={tag.id_tag} class="text-black">{tag.tag}</option>
    {/each}
  </select>

  <h2 class="font-bold ml-1 text-xl">Naturaleza del Proyecto:</h2>
  <select name="naturaleza" class="text-xl bg-transparent border-b-2 border-white focus:outline-none mb-6">
    {#each tags.Naturaleza as tag}
      <option selected={tag.checked} value={tag.id_tag} class="text-black">{tag.tag}</option>
    {/each}
  </select>

  <h2 class="font-bold ml-1 text-xl">Plataforma del Proyecto:</h2>
  <select name="plataforma" class="text-xl bg-transparent border-b-2 border-white focus:outline-none mb-6">
    {#each tags.Plataforma as tag}
      <option selected={tag.checked} value={tag.id_tag} class="text-black">{tag.tag}</option>
    {/each}
  </select>

  <h2 class="font-bold ml-1 text-xl">Propósito del Proyecto:</h2>
  <select name="propósito" class="text-xl bg-transparent border-b-2 border-white focus:outline-none mb-6">
    {#each tags.Propósito as tag}
      <option selected={tag.checked} value={tag.id_tag} class="text-black">{tag.tag}</option>
    {/each}
  </select>

  <h2 class="font-bold ml-1 text-xl">Tipo del Proyecto:</h2>
  <select name="tipo" class="text-xl bg-transparent border-b-2 border-white focus:outline-none mb-6">
    {#each tags.Tipo as tag}
      <option selected={tag.checked} value={tag.id_tag} class="text-black">{tag.tag}</option>
    {/each}
  </select>

  <input 
    type="submit"
    class="w-full bg-green-500 font-bold py-2 text-xl"
  >

  </form>
