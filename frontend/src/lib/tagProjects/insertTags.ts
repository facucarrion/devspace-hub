export const insertTags = async (formData:FormData) => {
  const response = await fetch('http://127.0.0.1:8080/api/tag-projects/insertTags', {
    method: 'POST',
    body: formData
})

  const data = await response.json()
  return data

}