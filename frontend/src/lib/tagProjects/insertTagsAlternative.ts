export const insertTagsAlternative = async (formData: {
  alcance: string,
  dominio: string,
  naturaleza: string,
  plataforma: string,
  proposito: string,
  tipo: string
}, id_project: string) => {
  const response = await fetch(`http://127.0.0.1:8080/api/tag-projects/insert_alternative/${id_project}`, {
    method: 'POST',
    body: JSON.stringify(formData)
  })

  const data = await response.json()
  console.log(data)
  return data

}