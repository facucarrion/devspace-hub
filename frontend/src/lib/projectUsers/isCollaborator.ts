export const isCollaborator = async (id_user: string, id_project: string) => {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/collab/check`, {
    method: 'PATCH',
    body: JSON.stringify({
      id_user,
      id_project
    })
  });
  const data = await response.json();
  return data;
}