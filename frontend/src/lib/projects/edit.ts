export const edit = async (id_project: string, formData: {
  title: string
  description: string
  url: File
}) => {
  const reponse = await fetch(`http://localhost:8080/api/projects/edit/${id_project}`, {
    method: 'POST',
    body: JSON.stringify(formData)
  })
  const data = await reponse.json()
  return data
}