import { expect, test } from '@playwright/test'

test('has title', async ({ page }) => {
  await page.goto('/')

  // Expect a title "to contain" a substring.
  await expect(page.locator('h1')).toHaveText(/Some php exercises/)
})

test('current time page', async ({ page }) => {
  await page.goto('/getCurrentTime.php')
  const h1 = page.locator('h1')

  const time = new Date().toISOString()
  await expect(h1).toBeVisible()
  await expect(h1).toHaveText(time.split('.')[0].split('T').join(' '))
})

test('get query parameters', async ({ page }) => {
  const name = 'John'
  const age = 30
  await page.goto(`/queryParameterDisplay.php?name=${name}&age=${age}`)
  const h1 = page.locator('h1')
  const ul = page.locator('ul')

  await expect(h1).toBeVisible()
  await expect(h1).toHaveText(`${name} is ${age} years old`)
  await expect(ul).toHaveCount(0)
})

test('no query parameters', async ({ page }) => {
  await page.goto('/queryParameterDisplay.php')
  const h1 = page.locator('h1')
  const li = page.locator('li')

  await expect(h1).toBeVisible()
  await expect(h1).toHaveText('No query parameters found')
  await expect(li).toHaveCount(2)
  await expect(li.first()).toHaveText('Missing name')
  await expect(li.last()).toHaveText('Missing age')
})

test('missing age query parameter', async ({ page }) => {
  await page.goto('/queryParameterDisplay.php?name=Toto')
  const h1 = page.locator('h1')
  const li = page.locator('li')

  await expect(h1).toBeVisible()
  await expect(h1).toHaveText('No query parameters found')
  await expect(li).toHaveCount(1)
  await expect(li.last()).toHaveText('Missing age')
})

test('missing name query parameter', async ({ page }) => {
  await page.goto('/queryParameterDisplay.php?age=12')
  const h1 = page.locator('h1')
  const li = page.locator('li')

  await expect(h1).toBeVisible()
  await expect(h1).toHaveText('No query parameters found')
  await expect(li).toHaveCount(1)
  await expect(li.last()).toHaveText('Missing name')
})

test('form is visible', async ({ page }) => {
  await page.goto('/formManagement.php')
  await expect(
    page.getByRole('heading', { name: 'Submit the form' }),
  ).toBeVisible()
  await expect(page.getByLabel('Name')).toBeVisible()
  await expect(page.getByLabel('Age')).toBeVisible()
  await expect(page.getByRole('button', { name: /submit/i })).toBeVisible()
})

test('server display name and age', async ({ page }) => {
  await page.goto('/formManagement.php')
  await page.getByLabel('Name').fill('John')
  await page.getByLabel('Age').fill('16')
  await page.getByRole('button', { name: /submit/i }).click()
  await expect(page.locator('h1')).toHaveText('John is 16 years old')
})

test('form with no submission', async ({ page }) => {
  await page.goto('/formManagement.php')
  await page.getByRole('button', { name: /submit/i }).click()
  await expect(page.locator('h1')).toHaveText('Submit the form')
})

test('server dont display if there is only name', async ({ page }) => {
  await page.goto('/formManagement.php')
  await page.getByLabel('Age').fill('16')
  await page.getByRole('button', { name: /submit/i }).click()
  await expect(page.locator('h1')).toHaveText('Submit the form')
})

test('server dont display if there is only age', async ({ page }) => {
  await page.goto('/formManagement.php')
  await page.getByLabel('Name').fill('John')
  await page.getByRole('button', { name: /submit/i }).click()
  await expect(page.locator('h1')).toHaveText('Submit the form')
})

test('server display long name in red', async ({ page }) => {
  await page.goto('/formManagement.php')
  await page.getByLabel('Name').fill('Bastien')
  await page.getByLabel('Age').fill('16')
  await page.getByRole('button', { name: /submit/i }).click()
  await expect(page.locator('h1')).toHaveText('Bastien is 16 years old')
  await expect(page.getByText('Bastien')).toHaveCSS('color', 'rgb(255, 0, 0)')
})

test('server display list for age above 18', async ({ page }) => {
  await page.goto('/formManagement.php')
  await page.getByLabel('Name').fill('Toto')
  await page.getByLabel('Age').fill('28')
  await page.getByRole('button', { name: /submit/i }).click()
  await expect(page.locator('h1')).toHaveText('Toto is 28 years old')
  await expect(page.locator('ul')).toBeVisible()
  const li = page.locator('li')
  await expect(li).toHaveCount(28)
  await expect(li.first()).toHaveText('1')
  await expect(li.last()).toHaveText('28')
})

test('data remain displayed in form after submission', async ({ page }) => {
  await page.goto('/formManagement.php')
  await page.getByLabel('Name').fill('Tata')
  await page.getByLabel('Age').fill('12')
  await page.getByRole('button', { name: /submit/i }).click()
  await expect(page.getByLabel('Name')).toHaveValue('Tata')
  await expect(page.getByLabel('Age')).toHaveValue('12')
})
