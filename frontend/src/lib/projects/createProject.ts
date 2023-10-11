export async function createProject(formData: FormData) {
  const response = await fetch('http://127.0.0.1:8080/api/projects', {
    method: 'POST',
    body: formData
  })

  const data = await response.json()

  return data
}