export async function getTags(id_project: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/tags/${id_project}`)
  const data = await response.json()
  return data
}