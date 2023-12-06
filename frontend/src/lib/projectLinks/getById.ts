export async function getById(id_project: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/links/${id_project}`)
  const data = await response.json()
  return data
}