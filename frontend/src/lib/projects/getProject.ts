export async function getProject(id: number) {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/${id}`)
  const data = await response.json()
  return data
}