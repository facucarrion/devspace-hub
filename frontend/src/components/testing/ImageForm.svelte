<script>
  import { loadImage } from '@lib/images'

  const handleSubmit = async event => {
    event.preventDefault()

    const form = event.target

    const inputFile = form.querySelector('input[type="file"]')
    const file = inputFile.files[0]

    const formData = new FormData()

    console.log(file)

    function getBlob(file) {
      const blob = new Blob([file], { type: file.type })

      return blob
    }

    const imageBlob = getBlob(file)

    formData.append('image', imageBlob, file.name)

    console.log(formData)

    const data = await loadImage(formData)

    console.log(data)
  }
</script>

<form
  enctype="multipart/form-data"
  class="flex flex-col items-center gap-2"
  on:submit={handleSubmit}
>
  <input type="file" accept="image/*" />
  <button type="submit" class="w-full bg-white text-black">Submit</button>
</form>
