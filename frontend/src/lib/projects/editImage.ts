export const editImage = async (id_project: string, formData: FormData) => {
  const reponse = await fetch(`http://localhost:8080/api/projects/editImage/${id_project}`, {
    method: 'POST',
    body: formData
  })
  const data = await reponse.json()
  return data
}