export const loadImage = async (formData: FormData) => {
  const reponse = await fetch('http://127.0.0.1:8080/api/images', {
    method: 'POST',
    body: formData
  })

  const data = await reponse.json()

  return data
}