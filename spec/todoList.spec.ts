import { expect, test } from '@playwright/test'

test('create a new todo', async ({ page }) => {
  await page.goto('/writeTodoToDatabase.php')
  const form = page.locator('form')
  const todoNameInput = form.locator('input[name="name"]')
  const todoDateInput = form.locator('input[name="date"]')

  await expect(form).toBeVisible()
  await expect(todoNameInput).toBeVisible()
  await expect(todoDateInput).toBeVisible()
  // Fill the form
  await todoNameInput.fill('Buy milk')
  await todoDateInput.fill('2021-12-24')
  // Submit the form
  await form.locator('button[type="submit"]').click()
  // Wait for the form to be hidden
  await page.waitForURL('/displayAllTodosFromDatabase.php')
  // Check that the todo is displayed
  await expect(page.locator('li')).toContainText(['Buy milk'])
})

test('delete a todo', async ({ page }) => {
  await page.goto('/displayAllTodosFromDatabase.php')
  const todo = page.locator('li').first()
  await expect(todo).toBeVisible()
  const text = await todo.textContent()
  const deleteButton = todo.locator('button')
  await expect(deleteButton).toBeVisible()
  await deleteButton.click()
  await page.waitForURL('/displayAllTodosFromDatabase.php')
  await expect(page.locator('li')).not.toContainText([text])
})
