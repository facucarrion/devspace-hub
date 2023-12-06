export const deleteProject = async (id_project: string) => {
  if(!window.confirm('Are you sure you want to delete this project?')) return

  const response = await fetch(`http://localhost:8080/api/projects/${id_project}`, {
    method: 'DELETE'
  })

  return response
}