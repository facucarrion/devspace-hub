export const getCollaborators = async (projectId: string) => {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/getCollab/${projectId}`);
  const data = await response.json();
  return data;
}