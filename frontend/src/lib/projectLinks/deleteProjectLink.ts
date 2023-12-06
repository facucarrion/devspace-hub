export const deleteProjectLink = async (id_project_link: string) => {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/links/${id_project_link}`, {
    method: 'DELETE'
  })
  const data = await response.json()
  return data
}